<?php

namespace App\Console\Commands;

use App\Models\Server;
use Illuminate\Console\Command;
use Exception;

class DownloadServers extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download-servers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int
     * @throws Exception
     */
    public function handle()
    {
        $path = storage_path() . "/json/servers_catalog.json";

        $json = json_decode(file_get_contents($path), true);

        $randomServersIndexes = array_rand($json['data'], 50);
        $servers              = Server::all();

        try {

            //Задание "слегка" станное. По сути мы кажый оаз перезаписываем полностью все записи, оэтому я бы сделал так:
            Server::query()->truncate();

            foreach ($randomServersIndexes as $index) {
                $this->createServer($json['data'][$index]);
            }
        } catch (Exception $exception) {
            $this->line('<fg=red>Error: ' . $exception->getMessage() . '</>');

            return 0;
        }

        //Но если же нам все же нужно следовать заданию и каждый раз искать по базе то я бы сделал так:
//        foreach ($servers as $server) {
//            foreach ($randomServersIndexes as $index) {
//                if ( ! $this->isSame($server, $json['data'][$index])) {
//                    $server->delete();
//                }
//            }
//        }
//        foreach ($randomServersIndexes as $index) {
//            if ($server = $this->existsInDatabase($json['data'][$index])) {
//                $this->updateServer($server, $json['data'][$index]);
//            } else {
//                $this->createServer($json['data'][$index]);
//            }
//        }
        $this->line('<fg=green>Servers downloaded</>');

        return 0;
    }

    private function updateServer(Server $server, array $fromJson): void
    {
        $server->provider       = $fromJson['provider'];
        $server->brand          = $fromJson['brand'];
        $server->location       = $fromJson['location'];
        $server->cpu            = $fromJson['cpu'];
        $server->drive          = $fromJson['drive'];
        $server->price          = $fromJson['price'];
        $server->city           = $fromJson['city'];
        $server->country        = $fromJson['country'];
        $server->datacenter     = $fromJson['datacenter'];
        $server->brand_label    = $fromJson['brand_label'];
        $server->model          = $fromJson['model'];
        $server->core           = $fromJson['core'];
        $server->ram            = $fromJson['ram'];
        $server->drive_label    = $fromJson['drive_label'];
        $server->bandwidth      = $fromJson['bandwidth'];
        $server->ip             = $fromJson['ip'];
        $server->show_bw        = $fromJson['show_bw'];
        $server->sell_out_start = $fromJson['sell_out_start'];
        $server->sell_out_end   = $fromJson['sell_out_end'];
        $server->discount       = $fromJson['discount'];
        $server->save();
    }

    private function createServer(array $fromJson): void
    {
        $server = new Server();
        $this->updateServer($server, $fromJson);
    }

    private function existsInDatabase(array $json)
    {
        return Server::where([
                ['provider', $json['provider']],
                ['brand', $json['brand']],
                ['location', $json['location']],
                ['cpu', $json['cpu']],
                ['drive', $json['drive']],
                ['price', $json['price']],
                ['city', $json['city']],
                ['country', $json['country']],
                ['datacenter', $json['datacenter']],
                ['brand_label', $json['brand_label']],
                ['model', $json['model']],
                ['core', $json['core']],
                ['ram', $json['ram']],
                ['drive_label', $json['drive_label']],
                ['bandwidth', $json['bandwidth']],
                ['ip', $json['ip']],
                ['show_bw', $json['show_bw']],
                ['sell_out_start', $json['sell_out_start']],
                ['sell_out_end', $json['sell_out_end']],
                ['discount', $json['discount']],
            ]
        )->first();
    }

    public function exists(array $servers, array $fromJson): bool
    {
        foreach ($servers as $server) {
            if ($this->isSame($server, $fromJson)) {
                return true;
            }
        }

        return false;
    }

    private function isSame(Server $server, array $json): bool
    {
        return $server->provider == $json['provider']
            && $server->brand == $json['brand']
            && $server->location == $json['location']
            && $server->cpu == $json['cpu']
            && $server->drive == $json['drive']
            && $server->price == $json['price']
            && $server->city == $json['city']
            && $server->country == $json['country']
            && $server->datacenter == $json['datacenter']
            && $server->brand_label == $json['brand_label']
            && $server->model == $json['model']
            && $server->core == $json['core']
            && $server->ram == $json['ram']
            && $server->drive_label == $json['drive_label']
            && $server->bandwidth == $json['bandwidth']
            && $server->ip == $json['ip']
            && $server->show_bw == $json['show_bw']
            && $server->sell_out_start == $json['sell_out_start']
            && $server->sell_out_end == $json['sell_out_end']
            && $server->discount == $json['discount'];
    }
}
