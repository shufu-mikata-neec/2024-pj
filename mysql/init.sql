CREATE TABLE user (
    user_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    screen_name VARCHAR(255) NOT NULL,
    password_reset_token VARCHAR(255),
    password_reset_token_expiration DATETIME
);

CREATE TABLE income_expenditure (
    user_id BIGINT PRIMARY KEY,
    in_out_id BIGINT PRIMARY KEY,
    category_id BIGINT,
    amount INT,
    date DATE,
    evidence_uuid BINARY(16)
);

CREATE TABLE category (
    user_id BIGINT PRIMARY KEY,
    category_id BIGINT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL
    category_type TINYINT NOT NULL
    is_deleted BOOLEAN NOT NULL
);

CREATE TABLE advice (
    user_id BIGINT PRIMARY KEY,
    advice_id BIGINT PRIMARY KEY,
    advice_type TINYINT NOT NULL,
    created_at DATETIME NOT NULL,
    report MEDIUMTEXT NOT NULL,
    content MEDIUMTEXT NOT NULL
);

CREATE TABLE subscription (
    user_id BIGINT PRIMARY KEY,
    subscription_id BIGINT PRIMARY KEY,
    subscription_name VARCHAR(255) NOT NULL,
    charge_date VARCHAR(255) NOT NULL
);

CREATE TABLE paymentt_method (
    user_id BIGINT PRIMARY KEY,
    paymentt_method_id BIGINT PRIMARY KEY,
    paymentt_method_name VARCHAR(255) NOT NULL
);