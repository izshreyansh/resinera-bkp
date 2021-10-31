<?php

namespace Modules\Report\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Report\TaxReport;
use Modules\Report\SalesReport;
use Modules\Report\SearchReport;
use Modules\Report\CouponsReport;
use Modules\Report\ShippingReport;
use Modules\Report\ProductsViewReport;
use Modules\Report\ProductsStockReport;
use Modules\Report\TaxedProductsReport;
use Modules\Report\CustomersOrderReport;
use Modules\Report\TaggedProductsReport;
use Modules\Report\BrandedProductsReport;
use Modules\Report\ProductsPurchaseReport;
use Modules\Report\CategorizedProductsReport;
use FleetCart\Exports\CouponsReport as CouponsReportExport;
use FleetCart\Exports\CustomersOrderReport as CustomersOrderReportExport;
use FleetCart\Exports\ProductsPurchaseReport as ProductsPurchaseReportExport;
use FleetCart\Exports\ProductsStockReport as ProductsStockReportExport;
use FleetCart\Exports\ProductsViewReport as ProductsViewReportExport;
use FleetCart\Exports\BrandedProductsReport as BrandedProductsReportExport;
use FleetCart\Exports\CategorizedProductsReport as CategorizedProductsReportExport;
use FleetCart\Exports\TaxedProductsReport as TaxedProductsReportExport;
use FleetCart\Exports\TaggedProductsReport as TaggedProductsReportExport;
use FleetCart\Exports\SalesReport as SalesReportExport;
use FleetCart\Exports\SearchReport as SearchReportExport;
use FleetCart\Exports\ShippingReport as ShippingReportExport;
use FleetCart\Exports\TaxReport as TaxReportExport;

class ReportController
{
    /**
     * Array of available reports.
     *
     * @var array
     */
    private $reports = [
        'coupons_report' => CouponsReport::class,
        'customers_order_report' => CustomersOrderReport::class,
        'products_purchase_report' => ProductsPurchaseReport::class,
        'products_stock_report' => ProductsStockReport::class,
        'products_view_report' => ProductsViewReport::class,
        'branded_products_report' => BrandedProductsReport::class,
        'categorized_products_report' => CategorizedProductsReport::class,
        'taxed_products_report' => TaxedProductsReport::class,
        'tagged_products_report' => TaggedProductsReport::class,
        'sales_report' => SalesReport::class,
        'search_report' => SearchReport::class,
        'shipping_report' => ShippingReport::class,
        'tax_report' => TaxReport::class,
    ];

    /**
     * Array of available reports.
     *
     * @var array
     */
    private $reportExports = [
        'coupons_report' => CouponsReportExport::class,
        'customers_order_report' => CustomersOrderReportExport::class,
        'products_purchase_report' => ProductsPurchaseReportExport::class,
        'products_stock_report' => ProductsStockReportExport::class,
        'products_view_report' => ProductsViewReportExport::class,
        'branded_products_report' => BrandedProductsReportExport::class,
        'categorized_products_report' => CategorizedProductsReportExport::class,
        'taxed_products_report' => TaxedProductsReportExport::class,
        'tagged_products_report' => TaggedProductsReportExport::class,
        'sales_report' => SalesReportExport::class,
        'search_report' => SearchReportExport::class,
        'shipping_report' => ShippingReportExport::class,
        'tax_report' => TaxReportExport::class,
    ];

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->query('type');

        if (! $this->reportTypeExists($type)) {
            return redirect()->route('admin.reports.index', ['type' => 'coupons_report']);
        }

        return $this->report($type)->render($request);
    }

    /**
     * Download a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        $type = $request->query('type');

        return (new $this->reportExports[$type])->download('report.csv');
    }

    /**
     * Determine if the report type exists.
     *
     * @param string $type
     * @return bool
     */
    private function reportTypeExists($type)
    {
        return array_key_exists($type, $this->reports);
    }

    /**
     * Returns a new instance of the given type of report.
     *
     * @param string $type
     * @return mixed
     */
    private function report($type)
    {
        return new $this->reports[$type];
    }
}
