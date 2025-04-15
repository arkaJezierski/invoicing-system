<?php

namespace App\Console\Commands;

use App\Services\NBPService;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Illuminate\Console\Command;
use DateTimeImmutable;
use NBP\Client;
use NBP\Exception\NotFoundException;
use NBP\HttpClient\Builder;

class ExchangeCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange:cron';
    protected Client $client;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command crone for refreshing Exchange Rate';


    public function __construct(
        protected NBPService $nbpService
    ){
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->localTime = microtime(true);

        try {
            $httpClientBuilder = new Builder();
            $httpClientBuilder->addPlugin(new BaseUriPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri('http://api.nbp.pl/api')));
            $httpClientBuilder->addPlugin(new HeaderDefaultsPlugin([
                'Accept' => 'application/json',
                'User-Agent' => 'php-nbp-api (https://github.com/johnzuk/php-nbp-api)',
            ]));
            $this->nbpService = new NBPService(new Client($httpClientBuilder));
            $startDate = (new DateTimeImmutable)->modify('-7 days');
            $endDate =  new DateTimeImmutable;

            $this->info('Imported currency exchange rates. Range ' . $startDate->format('Y-m-d') . ' - ' . $endDate->format('Y-m-d'));

            $mergedRates = $this->nbpService->getRates($startDate, $endDate);
            $this->nbpService->createExchangeRates($mergedRates);
        }
        catch (NotFoundException $e) {
            $this->info('Exchange rates table not found - Error!'.$e->getMessage() . ' ' . $e->getTraceAsString());
            return Command::FAILURE;
        }
        catch (\Error $e) {
            $this->info('Exchange rates import from NBP went wrong - Error!'.$e->getMessage() . ' ' . $e->getTraceAsString());
            return Command::INVALID;
        }

        $time = microtime(true) - $this->localTime;
        $this->info('Actual exchange rates from NBP is OK Run: '.round($time, 2).'s');
        return Command::SUCCESS;
    }
}
