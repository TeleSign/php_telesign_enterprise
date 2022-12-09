[![packagist](https://img.shields.io/packagist/v/telesign/telesignenterprise.svg)](https://packagist.org/packages/telesign/telesignenterprise) [![license](https://img.shields.io/github/license/TeleSign/php_telesign_enterprise.svg)](https://github.com/TeleSign/php_telesign_enterprise/blob/master/LICENSE)

# Telesign Full-service PHP SDK

[Telesign](https://telesign.com) connects, protects, and defends the customer experience with intelligence from billions of digital interactions and mobile signals. Through developer-friendly APIs that deliver user verification, digital identity, and omnichannel communications, we help the world's largest brands secure onboarding, maintain account integrity, prevent fraud, and streamline omnichannel engagement.

## Requirements

* **PHP 7.2+**
* **Composer** *(optional)* - This package manager isn't required to use this SDK, but it is required to use the installation instructions below.

> **NOTE:**
> 
> These instructions are for MacOS. They will need to be adapted if you are installing on Windows.

## Installation

Follow these steps to add this SDK as a dependency to your project. Both the Telesign Full-service PHP SDK and the Telesign Self-service PHP SDK are installed because the Full-service SDK also uses some functionality in the Self-service SDK.

1. *(Optional)* Create a new directory for your PHP project. Skip this step if you already have created a project. If you plan to create multiple PHP projects that use Telesign, we recommend that you group them within a `telesign_integrations` directory.
```
    cd ~/code/local
    mkdir telesign_integrations
    cd telesign_integrations
    mkdir {your project name}
    cd {your project name}
```
2. Install the SDK as a dependency in the top-level directory of your project using the command below. Once the SDK is installed, you should see a message in the terminal notifying you that you have successfully installed the SDK.

    `composer require telesign/telesignenterprise`

## Authentication

If you use a Telesign SDK to make your request, authentication is handled behind-the-scenes for you. All you need to provide is your Customer ID and API Key. The SDKs apply Digest authentication whenever they make a request to a Telesign service where it is supported. When Digest authentication is not supported, the SDKs apply Basic authentication.

## What's next

* Learn to send a request to Telesign with code with one of our [tutorials](https://developer.telesign.com/enterprise/docs/tutorials).  
* Browse our [Developer Portal](https://developer.telesign.com) for tutorials, how-to guides, reference content, and more.
* Check out our [sample code](https://github.com/TeleSign/sample_code) on GitHub.
