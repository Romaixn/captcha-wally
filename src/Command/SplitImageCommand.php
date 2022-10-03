<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\ImageFinder;
use App\Service\ImageSplitter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:split-image',
    description: 'Split given image in multiple',
)]
class SplitImageCommand extends Command
{
    public function __construct(
        private readonly ImageFinder $imageFinder,
        private readonly ImageSplitter $imageSplitter,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('image', InputArgument::OPTIONAL, 'Name of image to split (ie: images/wally-1.png)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Image splitter');

        /** @var string|null $image */
        $image = $input->getArgument('image');
        if (null !== $image) {
            $io->text(' > <info>Splitting image</info>: '.$image);
        } else {
            /** @var string $image */
            $image = $io->ask('Image to split (ie: images/wally-1.png)', 'images/wally-1.png');
        }

        $imagePath = $this->imageFinder->getAssetUrl($image);

        $this->imageSplitter->split($imagePath);

        $io->success('Image split successfully !');

        return Command::SUCCESS;
    }
}
