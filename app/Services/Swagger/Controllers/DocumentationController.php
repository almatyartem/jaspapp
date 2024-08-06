<?php

namespace App\Services\Swagger\Controllers;

use App\Services\Swagger\Swagger;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class DocumentationController
{

    public function getSwaggerData() : array
    {
        $enable = config('swagger.enable');
        if(!$enable) {
            abort(Response::HTTP_FORBIDDEN);
        }
        $swager_json = new Swagger;
        $response = $swager_json->swagger();

        return $response;
    }

    public function showViewDocumentation() : Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $response = $this->getSwaggerData();
        $versions = $this->reformatVersions();
        $themes = $this->getThemesList();
        $themes_path = url('g4t/swagger/themes');

        $stylesheet = config('swagger.stylesheet');
        return view('swagger/documentation', [
            'themes_path' => $themes_path,
            'response' => $response,
            'versions' => $versions,
            'stylesheet' => $stylesheet,
            'themes' => $themes
        ]);
    }

    private function reformatVersions()
    {
        $config = config('swagger');
        $versions = [];
        foreach ($config['versions'] as $version) {
            $versions[] = [
                'name' => $version,
                'url' => url($config["url"]."/json?version=$version")
            ];
        }
        $data['versions'] = $versions;
        $data['default'] = $config['default'];
        return $data;
    }

    private function getVersions()
    {
        $versions = config('swagger.versions');
        return $versions;
    }

    public function showJsonDocumentation()
    {
        $response = $this->getSwaggerData();
        return response()->json($response);
    }

    public function getThemesList()
    {
        try {
            $directory = public_path('g4t/swagger/themes');
            $files = File::files($directory);
            $fileNamesWithoutCss = [];
            $fileNamesWithoutCss[] = 'default';
            foreach ($files as $file) {
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                if (pathinfo($file, PATHINFO_EXTENSION) === 'css') {
                    $fileNameWithoutCss = str_replace('.css', '', $fileName);
                    $fileNamesWithoutCss[] = $fileNameWithoutCss;
                }
            }
            return $fileNamesWithoutCss;
        } catch (\Throwable $th) {
            $fileNamesWithoutCss[] = 'default';
            return $fileNamesWithoutCss;
        }
    }


}
