
# AISurveys Plugin

This plugin uses Google artificial intelligence (GEMINI) to take a survey and gives you recomendations based on question and configuration in admin view


## Requirements 

You need to have a GEMINI API KEY to use this plugin. 

You can get one for free here : https://ai.google.dev/gemini-api/docs/api-key


## Run this project locally

### pre-installs

You need to have installed first (we recomend run thi project in a linux debian based distribution): 

* nodejs
* npm
* Docker


Clone the project

```bash
  git clone https://github.com/berchj/AISurveys.git
```

Go to the project directory

```bash
  cd AISurveys
```

### environment commands 

Install dependencies

```bash
  npm i
```

Start local environment (this install all dependencies including wordpress and composer /phpunit for unit tests)

```bash
  make start
```


Run all unit test in ai-surveys/tests directory (see makefile to the entire command config)

```bash
  make test
```

Clean environments

```bash
  make clear
```

Debug environment

```bash
  make debug
```

Destroy environment

```bash
  make destroy
```

Make .zip to upload to wordpress

```bash
  make zip
```

### Unit tests 

This project is configured to accept unit tests written in the ai-entries/tests directory

To know more about how phpunit works: https://phpunit.de/manual/6.5/en/textui.html

### About wordpress/env : 

https://developer.wordpress.org/block-editor/reference-guides/packages/packages-env/


### npm package (installed as dependency in this project):

https://www.npmjs.com/package/@wordpress/env


## Support

For support, email info@glidestay.com .
