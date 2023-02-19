# Triggering a run with GitHub

The following documentation is specific to GitHub and partially out of the scope of this project.

Still we are going to see the section related to triggering a GitHub Action job.

If you need more information you should check the official documentation.

## `.github/workflows` directory

Everything related to GitHub Action is configured into the `.github/workflows` directory.

### Manual Trigger

This project comes with a working example configured with a *manual* trigger found in the `run.yml` file.

```yaml
name: run-job
on: workflow_dispatch

permissions:
  contents: read

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
```

To trigger a manual workflow got to: `https://github.com/[USERNAME]/[PROJECT]/actions/workflows/run.yml` and find the "Run Workflow" button.

### Scheduled Trigger

GitHub allows you to trigger a workflow on a given frequency, they use a cron-like syntaxe.

You can adapt the config file like this:
```yaml
name: run-job
on:
  workflow_dispatch: ~
  schedule:
    # Every day at 3am UTC
    - cron:  '0 3 * * *'
```

More detail at: [Events that trigger workflows > Schedule](https://docs.github.com/en/actions/using-workflows/events-that-trigger-workflows#schedule)

### Other Triggers 

Many other events can trigger a run, i.e.:
- deployment
- discussion
- issues
- label
- page_build
- pull_request
- pull_request_comment
- push
- release
- watch
- ...

Check out the [Official documentation](https://docs.github.com/en/actions/using-workflows/events-that-trigger-workflows)
