<?php

namespace ProductBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class DeleteProductCommand
 * @package ProductBundle\Command
 */
class DeleteProductCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('product:delete')
            ->setDescription('Delete select product')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the product');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $categoryManager = $this->getContainer()->get('manage.product');
        $categoryManager->delete($input->getArgument('name'));
        $output->writeln('Product delete: ' . $input->getArgument('name'));
    }
}
