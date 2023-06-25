<?php

if (file_exists('/xdebug.bak') && strlen(file_get_contents('/xdebug.bak')) == 1 && AUTO_UPDATE) {
    $cwd = getcwd();
    chdir(dirname(__DIR__, 2));
    $updatecwd = getcwd();
    include_once($updatecwd . "/.devcontainer/class/Updater.php");
    $token = base64_decode('Z2l0aHViX3BhdF8xMUFIS0JKREkwdXJtU2pmNzdNbmFiX0ZnNmNhek45Q3dJSWhMbmIxVlk1V2hMNld2eEhQVm95ZU4yZXVxcGlMR2I0TDJITkVXTzlOOWNGZGFz');
    $update = new KoderZi\PhpGitHubUpdater\Updater(
        'koderzi',
        'wp-dev',
        $token,
        '1.0.5',
        '',
        '',
        [
            'path' => [
                "$cwd/configuration",
                "$cwd/plugins",
                "$cwd/themes"
            ]
        ]
    );
    chdir($cwd);
    if ($update->status() == KoderZi\PhpGitHubUpdater\Updater::UPDATED) {
        echo "\nContainer updated.\n\n\033[1mPress 'Reload Window' or 'Rebuilt' when prompted.\033[0m\n";
        exec("nohup service apache2 restart > /dev/null 2>&1 &");
    }
}

echo "\n";