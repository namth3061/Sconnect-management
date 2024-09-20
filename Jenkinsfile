#!/usr/bin/env groovy
pipeline {
  agent any
  environment {
    PATH_PROJECT = '/var/www/sconnect-monitor'
  }
  stages {
    stage('Checkout') {
      steps {
        checkout scm
      }
    }
    stage('Install Dependencies') {
        steps {
          sh 'composer install'
          sh 'composer update'
          sh 'composer dump-autoload'
        }
    }
    stage('Run Tests') {
      steps {
        sh 'cp /var/www/.env .env'
        sh 'php artisan test'
      }
    }
    stage('Stop Conflicting Services') {
      steps {
        script {
          def ports = [8010]
          ports.each { port ->
            sh """
              echo "Killing process on port ${port}..."
              PID=\$(lsof -t -i:${port} || true)
              if [ -n "\$PID" ]; then
                  kill -9 \${PID}
                  echo "Process on port ${port} killed."
              else
                  echo "No process found on port ${port}."
              fi
            """
          }
        }
      }
    }
    stage('Check Source') {
      steps {
        script {
          echo "Copying source code..."
          sh "rsync -av --exclude='.git' --exclude='vendor' --exclude='node_modules' --exclude='storage' . $PATH_PROJECT"
        }
      }
    }
    stage('Prepare Environment') {
      steps {
        script {
          if (fileExists('$PATH_PROJECT/.env')) {
            echo "File .env found in $PATH_PROJECT"
          } else {
            sh 'cp /var/www/.env $PATH_PROJECT/.env'
          }
        }
      }
    }
    stage('Build') {
      steps {
        script {
          sh 'composer install'
          sh 'composer update'
          sh 'composer dump-autoload'
          sh 'npm install'
        }
      }
    }
    stage('Deploy') {
      steps {
        echo "Running source code in a fully containerized environment..."
        sh "cd $PATH_PROJECT"
        sh 'php artisan key:generate'
        sh 'php artisan view:clear'
        sh 'php artisan cache:clear'
        sh 'php artisan config:cache'
        sh 'php artisan config:clear'
      }
    }
  }
  post {
    success {
      echo 'Build, Tests, and Deploy successful!'
    }
    failure {
      echo 'Build and Tests failed!'
    }
    always {
      echo 'Cleaning up...'
    }
  }
}
