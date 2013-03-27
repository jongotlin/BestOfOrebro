<?php

namespace JGI\Bundle\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use JGI\Bundle\AppBundle\Entity\Post;

class ImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('bestoforebro:import')
            ->setDescription('Import latest posts')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $media = $em->getRepository('JGIAppBundle:Media')->getMediaForImport();

        $simplePie = $this->getContainer()->get('fkr_simple_pie.rss');
        $simplePie->set_raw_data(
            $this->getContainer()
                ->get('buzz.browser')
                ->get($media->getFeed())
                ->getContent()
        );
        $simplePie->init();

        $items = $simplePie->get_items();
        $nrOfImportedPosts = 0;
        foreach($items as $item) {
            if (false === strpos($item->get_link(), 'dagens.etc.se')) { // Ugly check for ETC posting non local stories in their feed
                if (is_null($em->getRepository('JGIAppBundle:Post')->findOneByUrl($item->get_link()))) {
                    $nrOfImportedPosts++;

                    $post = new Post();
                    $post->setMedia($media);
                    $post->setTitle(str_replace("\n", '', html_entity_decode($item->get_title())));
                    $post->setDate(new \DateTime($item->get_date('Y-m-d H:i:s')));
                    $post->setBody(html_entity_decode(strip_tags($item->get_content())));
                    $post->setUrl($item->get_link());
                    $post->setFacebookLikes($this->getContainer()->get('social_counter')->getFacebookLikes($post->getUrl()));
                    $post->setTwitterShares($this->getContainer()->get('social_counter')->getTwitterShares($post->getUrl()));

                    $output->writeln(sprintf('<info>%s</info> %s', $post->getDate()->format('Y-m-d H:i'), $post->getTitle()));

                    $em->persist($post);
                }
            }
        }

        $media->setUpdatedAt(new \DateTime());
        $em->persist($media);
        $em->flush();

        $output->writeln(sprintf('Imported <comment>%d</comment> posts for <comment>%s</comment>.', $nrOfImportedPosts, $media->getName()));
    }
} 