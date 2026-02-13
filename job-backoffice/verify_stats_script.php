<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
  echo "Initializing widget...\n";
  $w = new \App\Filament\Resources\Users\Widgets\JobSeekerStats();

  echo "Reflecting getStats...\n";
  $r = new ReflectionMethod($w, 'getStats');
  $r->setAccessible(true);

  echo "Invoking getStats...\n";
  $stats = $r->invoke($w);

  echo "Stats count: " . count($stats) . "\n";

  foreach ($stats as $stat) {
    echo "--------------------------------------------------\n";
    echo "Label: " . $stat->getLabel() . "\n";
    echo "Value: " . $stat->getValue() . "\n";

    // Helper to access protected properties if needed, but getChart might be public or accessible via reflection
    // Filament Stat class usually has getChart()
    if (method_exists($stat, 'getChart')) {
      echo "Chart: " . json_encode($stat->getChart()) . "\n";
    } else {
      echo "Chart: (method getChart not found)\n";
    }
  }
  echo "--------------------------------------------------\n";
  echo "Verification Successful!\n";

} catch (\Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
  echo $e->getTraceAsString();
  exit(1);
}
