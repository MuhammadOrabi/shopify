@servers(['localhost' => '127.0.0.1'])

@setup
    $repository = 'git@gitlab.example.com:<USERNAME>/laravel-sample.git';
    $releases_dir = '/var/www/app/releases';
    $app_dir = '/var/www/app';
    $release = date('YmdHis');
    $new_release_dir = $releases_dir .'/'. $release;
    $heroku = 'https://heroku:5b271f58-d3a9-44f3-8202-a49d5a8a8330@git.heroku.com/shopify-orabi.git';
@endsetup

@story('deploy')
    push_to_heroku
@endstory

@task('push_to_heroku')
    git push {{ $heroku }} HEAD
    git remote add heroku git.heroku.com/shopify-orabi.git
    git push heroku master
@endtask


@task('clone_repository')
    echo 'Cloning repository'
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
@endtask

@task('run_composer')
    echo "Starting deployment ({{ $release }})"
    cd {{ $new_release_dir }}
    composer install --prefer-dist --no-scripts -q -o
@endtask

@task('update_symlinks')
    echo "Linking storage directory"
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage

    echo 'Linking .env file'
    ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env

    echo 'Linking current release'
    ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current
@endtask
