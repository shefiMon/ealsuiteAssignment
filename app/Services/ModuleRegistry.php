<?php
namespace App\Services;

use App\Contracts\CrudeServiceInterface;
use App\Interfaces\ModuleServiceInterface;

class ModuleRegistry
{
    protected $services = [
        'customer' => \App\Modules\Customers\Services\CustomerService::class,
        'invoice' => \App\Modules\Invoices\Services\InvoiceService::class,
        // Add other modules here
    ];


    public function get(string $module): ?ModuleServiceInterface
    {
        if (!isset($this->services[strtolower($module)])) {
            return null;
        }
        return app($this->services[strtolower($module)]);
    }
}
