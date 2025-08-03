<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Store;

class ManageStores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:manage {action} {--id=} {--name=} {--address=} {--phone=} {--lat=} {--lng=} {--active=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage stores via command line';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
            case 'list':
                $this->listStores();
                break;
            case 'add':
                $this->addStore();
                break;
            case 'update':
                $this->updateStore();
                break;
            case 'delete':
                $this->deleteStore();
                break;
            case 'toggle':
                $this->toggleStore();
                break;
            default:
                $this->error('Available actions: list, add, update, delete, toggle');
                $this->info('Examples:');
                $this->info('php artisan store:manage list');
                $this->info('php artisan store:manage add --name="New Store" --address="Jl. Example" --phone="+62123456789" --lat=-6.2088 --lng=106.8456');
                $this->info('php artisan store:manage update --id=1 --name="Updated Name"');
                $this->info('php artisan store:manage delete --id=1');
                $this->info('php artisan store:manage toggle --id=1');
        }
    }

    private function listStores()
    {
        $stores = Store::all();
        
        if ($stores->isEmpty()) {
            $this->info('No stores found.');
            return;
        }

        $this->table(
            ['ID', 'Name', 'Address', 'Phone', 'Active', 'Order'],
            $stores->map(function ($store) {
                return [
                    $store->id,
                    $store->name,
                    $store->address,
                    $store->phone,
                    $store->is_active ? 'Yes' : 'No',
                    $store->order_sort
                ];
            })
        );
    }

    private function addStore()
    {
        $name = $this->option('name') ?: $this->ask('Store name?');
        $address = $this->option('address') ?: $this->ask('Address?');
        $phone = $this->option('phone') ?: $this->ask('Phone?');
        $lat = $this->option('lat') ?: $this->ask('Latitude?');
        $lng = $this->option('lng') ?: $this->ask('Longitude?');
        
        $store = Store::create([
            'name' => $name,
            'description' => $this->ask('Description?', 'Professional barbershop services'),
            'address' => $address,
            'phone' => $phone,
            'hours' => $this->ask('Operating hours?', '09:00 - 21:00'),
            'latitude' => floatval($lat),
            'longitude' => floatval($lng),
            'image' => 'images/stores/default.jpg',
            'is_active' => $this->option('active') == '1',
            'order_sort' => Store::max('order_sort') + 1,
        ]);

        $this->info("Store '{$store->name}' created successfully with ID: {$store->id}");
    }

    private function updateStore()
    {
        $id = $this->option('id') ?: $this->ask('Store ID to update?');
        $store = Store::find($id);

        if (!$store) {
            $this->error("Store with ID {$id} not found.");
            return;
        }

        $updates = [];
        if ($this->option('name')) $updates['name'] = $this->option('name');
        if ($this->option('address')) $updates['address'] = $this->option('address');
        if ($this->option('phone')) $updates['phone'] = $this->option('phone');
        if ($this->option('lat')) $updates['latitude'] = floatval($this->option('lat'));
        if ($this->option('lng')) $updates['longitude'] = floatval($this->option('lng'));

        if (empty($updates)) {
            $this->error('No update options provided.');
            return;
        }

        $store->update($updates);
        $this->info("Store '{$store->name}' updated successfully.");
    }

    private function deleteStore()
    {
        $id = $this->option('id') ?: $this->ask('Store ID to delete?');
        $store = Store::find($id);

        if (!$store) {
            $this->error("Store with ID {$id} not found.");
            return;
        }

        if ($this->confirm("Are you sure you want to delete '{$store->name}'?")) {
            $store->delete();
            $this->info("Store '{$store->name}' deleted successfully.");
        }
    }

    private function toggleStore()
    {
        $id = $this->option('id') ?: $this->ask('Store ID to toggle?');
        $store = Store::find($id);

        if (!$store) {
            $this->error("Store with ID {$id} not found.");
            return;
        }

        $store->update(['is_active' => !$store->is_active]);
        $status = $store->is_active ? 'activated' : 'deactivated';
        $this->info("Store '{$store->name}' {$status} successfully.");
    }
}
