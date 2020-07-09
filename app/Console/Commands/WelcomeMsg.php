<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WelcomeMsg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'welcome:msg';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //$this->info('我的第一個Artisan命令!來自於'.$this->option('city').'的'.$this->argument('name'));
        $name = $this->ask('你叫什麼名字');
        $city = $this->choice('你来自哪个城市', [ 
            "台北", 
            "新北", 
            "花蓮" 
        ],0);

        if ($this->confirm('确定要執行此命令吗?')) {
            $this->info('我的第一個Artisan命令!來自於'.$city.'的'.$name);
        } else {
            exit(0);
        }

        
    }
}
