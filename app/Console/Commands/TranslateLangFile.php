<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Google\Cloud\Translate\V2\TranslateClient;

class TranslateLangFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:translate-json {from=en} {to=lv}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Google API lang.json translation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $from = $this->argument('from');
        $to = $this->argument('to');

        $sourcePath = resource_path("lang/{$from}.json");
        $targetPath = resource_path("lang/{$to}.json");

        if (!File::exists($sourcePath)) {
            $this->error("File not found: {$sourcePath}");
            return;
        }

        $sourceData = json_decode(File::get($sourcePath), true);
        $targetData = File::exists($targetPath)
            ? json_decode(File::get($targetPath), true)
            : [];

        $translate = new TranslateClient([
            'keyFilePath' => env('GOOGLE_APPLICATION_CREDENTIALS'),
        ]);

        $newTranslations = 0;

        foreach ($sourceData as $key => $text) {
            if (!isset($targetData[$key])) {
                $translated = $translate->translate($text, [
                    'target' => $to,
                    'source' => $from,
                ]);
                $targetData[$key] = $translated['text'];
                $newTranslations++;
                $this->info("Translated: $text → {$translated['text']}");
            }
        }

        File::put($targetPath, json_encode($targetData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $this->info("✅ Translation complete. {$newTranslations} new entries added to {$to}.json");
    }
}
