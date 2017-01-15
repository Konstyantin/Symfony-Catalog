<?php

namespace CategoryBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class DeleteCategoryCommand
 * @package CategoryBundle\Command
 */
class DeleteCategoryCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('category:delete')
            ->setDescription('Delete category')
            ->setHelp('This command allow you to delete category')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the category');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $manageCategory = $this->getContainer()->get('manage.category');
        $manageCategory->delete($input->getArgument('name'));
        $output->writeln('Category name: ' . $input->getArgument('name'));
    }
}
