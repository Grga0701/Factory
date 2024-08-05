<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240805145303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO category (name, description) VALUES ('Electronics', 'Devices, gadgets, and accessories'), ('Books', 'Fiction, non-fiction, educational, and more'), ('Clothing', 'Men, women, and children apparel'), ('Home & Kitchen', 'Furniture, appliances, and kitchenware'), ('Sports & Outdoors', 'Sports equipment, outdoor gear, and fitness products');");
        $this->addSql("INSERT INTO product (name, description, sku, published, category) VALUES ('Smartphone', 'A high-end smartphone with the latest features.', 1001, 1, 1), ('Laptop', 'A powerful laptop for all your computing needs.', 1002, 1, 1), ('Fiction Novel', 'An engaging fiction novel that you won\'t be able to put down.', 2001, 1, 2), ('Textbook', 'A comprehensive textbook for learning new subjects.', 2002, 1, 2), ('Men\'s Jacket', 'A stylish and warm jacket for men.', 3001, 1, 3), ('Women\'s Dress', 'A beautiful dress for special occasions.', 3002, 1, 3), ('Blender', 'A high-performance blender for your kitchen.', 4001, 1, 4), ('Coffee Maker', 'A coffee maker that brews the perfect cup every time.', 4002, 1, 4), ('Running Shoes', 'Comfortable and durable running shoes.', 5001, 1, 5), ('Yoga Mat', 'A high-quality yoga mat for your fitness needs.', 5002, 1, 5);");
        $this->addSql("INSERT INTO price_list (name, price, sku) VALUES ('Smartphone', 699.99, 1001), ('Laptop', 1199.99, 1002), ('Fiction Novel', 19.99, 2001), ('Textbook', 89.99, 2002), ('Men\'s Jacket', 59.99, 3001), ('Women\'s Dress', 49.99, 3002), ('Blender', 79.99, 4001), ('Coffee Maker', 99.99, 4002), ('Running Shoes', 89.99, 5001), ('Yoga Mat', 29.99, 5002);");
        $this->addSql("INSERT INTO user (name, lastname, phone_number, date_of_birth, date_of_registration) VALUES ('John', 'Doe', 1234567890, '1985-05-15 00:00:00', '2024-08-01 12:00:00'), ('Jane', 'Smith', 9876543210, '1990-08-22 00:00:00', '2024-08-01 12:30:00'), ('Alice', 'Johnson', 5556667777, '1992-11-03 00:00:00', '2024-08-01 13:00:00'), ('Bob', 'Williams', 1231231234, '1980-02-28 00:00:00', '2024-08-01 13:30:00'), ('Carol', 'Brown', 9879879876, '1988-06-17 00:00:00', '2024-08-01 14:00:00'), ('David', 'Jones', 5555555555, '1995-12-05 00:00:00', '2024-08-01 14:30:00'), ('Eve', 'Garcia', 2345678901, '1993-03-23 00:00:00', '2024-08-01 15:00:00'), ('Frank', 'Miller', 8765432109, '1987-09-09 00:00:00', '2024-08-01 15:30:00'), ('Grace', 'Davis', 3456789012, '1991-01-19 00:00:00', '2024-08-01 16:00:00'), ('Hank', 'Martinez', 7654321098, '1982-07-13 00:00:00', '2024-08-01 16:30:00');");
        $this->addSql("INSERT INTO contract_list (user_id, price, sku, modificator, modificator_value) VALUES (1, 650.00, 1001, 'special_price', 50), (1, 1150.00, 1002, 'special_price', 50), (2, 18.99, 2001, 'discount', 10), (2, 85.00, 2002, 'special_price', 5), (3, 57.00, 3001, 'discount', 5), (3, 45.00, 3002, 'special_price', 5), (4, 75.00, 4001, 'discount', 5), (4, 95.00, 4002, 'special_price', 5), (5, 85.00, 5001, 'discount', 5), (5, 27.00, 5002, 'special_price', 2);");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
