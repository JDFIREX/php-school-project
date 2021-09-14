  
create database jonatanblog;
use jonatanblog;

create table user_login(
        user_id int auto_increment not null,
        nickName varchar(50) not null,
        password varchar(500) not null,
        primary key(user_id)
);

create table article_category (
        category_id int auto_increment not null,
        category varchar(50) not null,
        primary key(category_id)
);

create table article (
        article_id int auto_increment not null,
        article_header varchar(255) not null,
        article_src varchar(1000),
        article_text varchar(10000) not null,
        article_category_id int,
        article_created DATE not null,
        article_updated DATE not null,
        article_owner_id int,
        FOREIGN KEY(article_category_id) REFERENCES article_category (category_id),
        FOREIGN KEY(article_owner_id) REFERENCES user_login (user_id),
        primary key(article_id)
);

create table article_comment (
        comment_id int auto_increment not null,
        comment_for_article_id int not null,
        comment_owner_id int not null,
        comment varchar(255) not null,
        FOREIGN KEY(comment_for_article_id) references article(article_id),
        FOREIGN KEY(comment_owner_id) references user_login(user_id),
        primary key(comment_id)
);



