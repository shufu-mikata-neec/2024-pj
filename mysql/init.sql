CREATE TABLE user (
    user_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    screen_name VARCHAR(255) NOT NULL,
    password_reset_token VARCHAR(255),
    password_reset_token_expiration DATETIME
);

CREATE TABLE income_expenditure (
    user_id BIGINT,
    in_out_id BIGINT,
    category_id BIGINT,
    amount INT,
    created_at DATE,
    evidence_uuid BINARY(16),
    PRIMARY KEY (user_id, in_out_id)
);

CREATE TABLE category (
    user_id BIGINT,
    category_id BIGINT,
    category_name VARCHAR(255) NOT NULL,
    category_type TINYINT NOT NULL,
    is_deleted BOOLEAN NOT NULL,
    PRIMARY KEY (user_id, category_id)
);

CREATE TABLE advice (
    user_id BIGINT,
    advice_id BIGINT,
    advice_type TINYINT NOT NULL,
    created_at DATETIME NOT NULL,
    report MEDIUMTEXT NOT NULL,
    content MEDIUMTEXT NOT NULL,
    PRIMARY KEY (user_id, advice_id)
);

CREATE TABLE subscription (
    user_id BIGINT,
    subscription_id BIGINT,
    subscription_name VARCHAR(255) NOT NULL,
    charge_date VARCHAR(255) NOT NULL,
    PRIMARY KEY (user_id, subscription_id)
);

CREATE TABLE paymentt_method (
    user_id BIGINT,
    paymentt_method_id BIGINT,
    paymentt_method_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (user_id, paymentt_method_id)
);

INSERT INTO user (email, password_hash, screen_name) VALUES (
    'hoge@example.com',
    '$2y$10$BmZwceLbgT2voKRtHpnl5OvLinhtJ1X2nDE8Nk8VSl8.5OwNlItZ2',
    'hoge'
);