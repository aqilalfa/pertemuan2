# Course Manager

Simple CLI Course Manager (PHP). Persistent storage: data/courses.json.

## Setup

1. `composer install`
2. (Buat folder data) `mkdir -p data && echo "[]" > data/courses.json`
3. Make console executable: `chmod +x bin/console`

## Usage

- List: `php bin/console list`
- Create: `php bin/console create "Nama Matakuliah" "Deskripsi"`
- Get: `php bin/console get <id>`
- Delete: `php bin/console delete <id>`

## Run tests

`./vendor/bin/phpunit`

## CI

Workflow GitHub Actions disertakan di `.github/workflows/phpunit.yml`.
