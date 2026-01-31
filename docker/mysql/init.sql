USE app;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES
  ("admin","abc123");

CREATE TABLE IF NOT EXISTS blogpost (
  id INT AUTO_INCREMENT PRIMARY KEY,
  content TEXT NOT NULL,
  imagelink VARCHAR(100)
);

INSERT INTO blogpost (content, imagelink) VALUES
  (
'
# Welcome to My Blog
## Introduction
This is the first post on my brand new blog. Here I will share tips, stories, and updates. Every time I go to the lake I feel much more at home than last time. This was the second time this year already.

### About Me
I am a web developer who loves coding, coffee, and cats.

#### Fun Fact
I once built a website in just 24 hours!

##### Motivation
Stay curious and keep learning.

###### Footer Note
Thank you for reading! Looking forward to having you here on the blog!

This is a simple paragraph to conclude the post.',
'lake.jpg'
),
  (
'
# Travel Adventures
## Europe Trip 2025
Last summer, I traveled across Europe. It was an unforgettable experience.

### Cities Visited
- Paris
- Rome
- Barcelona
- Amsterdam

#### Favorite Memory
Watching the sunset over the canals of Venice.

##### Travel Tip
Always carry a power bank for your phone.

###### Packing Reminder
Don’t forget comfortable shoes!

Here’s a paragraph summarizing the trip and lessons learned.',
'trees.jpg'
),
  (
'
# Cooking at Home
## Easy Recipes
Cooking can be fun and easy with the right recipes.

### Recipe: Chocolate Cake
Ingredients:
- Flour
- Cocoa Powder
- Eggs
- Sugar
- Butter

#### Steps
1. Preheat oven to 180°C
2. Mix ingredients
3. Bake for 30 minutes

##### Serving Suggestion
Add fresh berries on top.

###### Quick Tip
Always measure your ingredients carefully.

This paragraph wraps up the post and encourages readers to try cooking at home.',
'cabin.jpg'
);
