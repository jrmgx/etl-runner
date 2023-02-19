# Triggering a run with GitLab

The following documentation is specific to GitLab and partially out of the scope of this project.

Still we are going to see the section related to triggering a GitLab CI job.

If you need more information you should check the official documentation.

## `.gitlab-ci.yml`

Everything related to GitLab CI is configured into the `.gitlab-ci.yml` file.

### Manual Trigger

This project comes with a working example configured with a *manual* trigger.

```yaml
stages:
  - run

run-job:
  stage: run
  image: php:8.1-cli-alpine
  when: manual
  cache:
    paths:
      - app/vendor
    key:
      files:
        - app/composer.lock
  script:
    - cd app
    - php composer.phar install
    - php bin/console etl:run
```

The key part in this file is the line `when: manual` which specify for a manual trigger.

To trigger a manual pipeline:
- Got to: `https://gitlab.com/[USERNAME]/[PROJECT]/-/pipelines/new` and find the "Run Pipeline" button
- On the next page, click on the "play" button next to "run-job"

### Scheduled Trigger

GitLab allows you to run a pipeline on a given frequency, they use a web based interface to configure it:  
`https://gitlab.com/[USERNAME]/[PROJECT]/-/pipeline_schedules/new`  
Find more information at: [Scheduled pipelines](https://docs.gitlab.com/ee/ci/pipelines/schedules.html)

### Other Triggers

You can configure other way to trigger your pipeline/jobs, checkout the official documentation:
- [Choose when to run jobs](https://docs.gitlab.com/ee/ci/jobs/job_control.html)
- [Trigger pipelines by using the API](https://docs.gitlab.com/ee/ci/triggers/)
