# Changelog

All notable changes to `notaCMS` will be documented in this file.

## Bug Fix - 2024-01-03

It redirects the user to index when slug not found.

## First Release v1.0.0 - 2024-01-03

- It can create a new blog with command `notacms:new {Blogname}`
- It automatically publishes the Model, Migration, Views and Blog stub.
- It automatically routes the index and show routes.
- The blog file is a .md file with Front Matter
- All the front matter are loaded to database, while the `meta_` fields to the relative seo table from RalphJ package.
- Console command `notacms:load {Blogname}` loads all the files in the database, and updates existing fields.
