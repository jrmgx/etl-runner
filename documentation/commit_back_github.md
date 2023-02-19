# Commit Back to GitHub

The following documentation is specific to GitHub and partially out of the scope of this project.

Still we are going to see the section related to committing back your changes to GitHub.

If you need more information you should check the official documentation.

## Using `stefanzweifel/git-auto-commit-action`

The easiest way to commit back the changes made by running the ETL is to use a specific action:
[stefanzweifel/git-auto-commit-action](https://github.com/stefanzweifel/git-auto-commit-action)

```yaml
# (...)
jobs:
  run-job:
    runs-on: ubuntu-latest
    steps:
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.1'
      - uses: actions/checkout@v3
      - name: Cache
        id: composer-cache
        uses: actions/cache@v3
        with:
          path: app/vendor
          key: ${{ runner.os }}-php-${{ hashFiles('app/composer.lock') }}
      - name: Run
        run: |
          cd app
          php composer.phar install
          php bin/console etl:run
      # new config related to stefanzweifel/git-auto-commit-action
      - name: Commit back to repository
        uses: stefanzweifel/git-auto-commit-action@v4
        with:
          commit_message: New data saved!
```

This is out of the project scope, please refer to the documentation above.
