# Where's Wally ?
Nowadays, we are often confronted with "Captcha".

These tests to know if we are robots or not.

They are all very boring and not very fun.

Imagine a world where to submit a form on your favorite site, you have to find Wally (or Waldo or Charlie).

Yes, you know this guy:

[![Wally](docs/wally.jpeg)](https://en.wikipedia.org/wiki/Where%27s_Wally%3F)

The goal of this project is to implement a captcha where the objective is to find Wally.

## :toolbox: Getting Started
### :space_invader: Tech Stack
- [Symfony](https://symfony.com)
- [Tailwind CSS](https://tailwindcss.com)

### :bangbang: Prerequisites
You need to have [PHP](https://www.php.net/) and [Composer](https://getcomposer.org/) installed on your computer.

### :gear: Installing
Clone the project:
```bash
git clone https://github.com/Romaixn/captcha-wally.git
```

Install the dependencies:
```bash
composer install
npm i
```

Run the server:
With Symfony Binary :
```bash
symfony serve -d 
```

Or with PHP :
```bash
php -S localhost:8000 -t public
```

Build the assets:
```bash
npm run dev
```

Split base image:
```bash
php bin/console app:split-image images/wally-1.png
```

And go to [https://localhost:8000](https://localhost:8000) 🚀

## 🤝 Contributing

Contributions, issues and feature requests are welcome !<br />Feel free to check [issues page](https://github.com/Romaixn/captcha-wally/issues).

To contribute to this project, please follow these steps:

Fork this repository.

Clone your forked repository.

Follow the [Installing](#gear-installing) section.

After that, you can make your changes.

Run the analysis tool to ensure that everything is working. :
```bash
vendor/bin/psalm
```

Fix the code style:
```bash
vendor/bin/php-cs-fixer fix
```

## Show your support

Give a ⭐️ if you like this project !