<?php

namespace JGI\Bundle\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use JGI\Bundle\AppBundle\Entity\Post;

class UpdateSocialCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('bestoforebro:update-social')
            ->setDescription('Update social activities for latest posts')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $posts = $em->getRepository('JGIAppBundle:Post')->getPostsForSocialUpdate();
        foreach ($posts as $post) {
            $post->setFacebookLikes($this->getContainer()->get('social_counter')->getFacebookLikes($post->getUrl()));
            $post->setTwitterShares($this->getContainer()->get('social_counter')->getTwitterShares($post->getUrl()));

            $output->writeln(sprintf('<info>%s</info> %d + %d', $post->getTitle(), $post->getFacebookLikes(), $post->getTwitterShares()));
            $em->persist($post);
        }

        $em->flush();

    }
} 