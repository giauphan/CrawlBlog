# README - Crawler Blog for Laravel

## Overview
Welcome to the Crawler Blog for Laravel repository! This robust web scraping tool is crafted to effortlessly gather data from blogs and websites, delivering valuable insights and information. Whether you're a content creator, market researcher, or e-commerce entrepreneur, this Laravel-based crawler provides an ideal solution for your data extraction needs.

## Features
- **Web Scraping:** Extract data from various blogs and websites, including blog posts, product descriptions, prices, and customer reviews.
- **User-Friendly Interface:** The crawler features a simple and intuitive interface suitable for both experts and beginners.
- **Customizable Search Parameters:** Tailor search criteria to match specific requirements. Filter results by date, location, product category, and more.
- **Automated Updates:** Stay up-to-date with automated scheduling and regular data updates.
- **Data Visualization and Export:** Analyze and comprehend extracted data with built-in visualization tools. Export data in formats like CSV, Excel, or JSON for further analysis or integration.
- **Privacy and Security:** Operates ethically, respecting website terms of service to ensure user privacy and security.

## Installation
Follow these steps to get the Crawler Blog for Laravel up and running:

1. **Clone the repository:**
    ```bash
    composer require giauphan/crawl-blog-data -W
    ```

You need to add provider and alias to your config/app.php file:
```
<?php

'providers' => [     

    Giauphan\CrawlBlog\CrawlBlogDataServiceProvider::class  
  
],
```

You can publish and run the migrations with:
```
php artisan vendor:publish --provider="Giauphan\CrawlBlog\CrawlBlogDataServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```
php artisan vendor:publish --provider="Giauphan\CrawlBlog\CrawlBlogDataServiceProvider" --tag="command"
```

2. **Configuration:**
    - Update the `.env` file to configure the database settings.
    - Adjust the `CrawlBlogData.php` file to customize scraping behavior based on your requirements.

You can generate a new settings class using this artisan command.
```
 php artisan make:crawl-blog CrawlExample
```

3. **Executing the Crawler:**
    Run the crawler via the command line using the following command:
    ```bash
    php artisan app:CrawlExample url category_name
    ```
    This initiates the web scraping process, and the extracted data will be saved to the configured database tables.

## Contributions
We welcome contributions from the community! If you encounter bugs, have feature requests, or want to enhance the crawler, please submit issues or pull requests on GitHub.

## License
The Crawler Blog for Laravel is open-source software licensed under the MIT License. Feel free to use, modify, and distribute it following the license terms.

## Contact
For inquiries or support, contact us at Giauphan012@gmail.com.

Thank you for using the Crawler Blog for Laravel! Happy scraping!
