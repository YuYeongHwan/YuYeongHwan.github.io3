CREATE TABLE ticket_bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    child_en INT NOT NULL,
    child_big INT NOT NULL,
    child_free INT NOT NULL,
    child_year INT NOT NULL,
    adult_en INT NOT NULL,
    adult_big INT NOT NULL,
    adult_free INT NOT NULL,
    adult_year INT NOT NULL,
    total_price INT NOT NULL,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
