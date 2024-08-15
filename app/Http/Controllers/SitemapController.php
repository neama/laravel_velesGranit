<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class SitemapController extends Controller
{
    public function index(Request $request)
    {
        $host = $request->getHost();
        $path = 'app/xml/' . $host . '/sitemap.xml';

        $path = storage_path($path);

        if (!File::exists($path)) {
            $this->createSitemapXml($host);
        }else{
            $lastModified = File::lastModified($path);

            // Создаем объект Carbon для текущего времени и времени последнего изменения
            $lastModifiedTime = Carbon::createFromTimestamp($lastModified);
            $currentTime = Carbon::now();
            if ($lastModifiedTime->diffInMinutes($currentTime) > 2) {
                $this->createSitemapXml($host);
            }
        }
        $content = File::get($path);
        return response($content, 200)->header('Content-Type', 'application/xml');
    }

    private function createSitemapXml(string $host):void
    {
        $path = storage_path("app/xml/".$host."/sitemap.xml");

        // Пример данных для sitemap
        $sitemapContent = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemapContent .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $sitemapContent .= '<url><loc>' . url('/') . '</loc><lastmod>' . now()->toAtomString() . '</lastmod><changefreq>monthly</changefreq><priority>1.0</priority></url>';
        $sitemapContent .= '<url><loc>' . url('/ru') . '</loc><lastmod>' . now()->toAtomString() . '</lastmod><changefreq>monthly</changefreq><priority>1.0</priority></url>';
        $sitemapContent .= '<url><loc>' . url('/ro') . '</loc><lastmod>' . now()->toAtomString() . '</lastmod><changefreq>monthly</changefreq><priority>1.0</priority></url>';
        $sitemapContent .= '<url><loc>' . url('/ru/catalog/index') . '</loc><lastmod>' . now()->toAtomString() . '</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>';
        $sitemapContent .= '<url><loc>' . url('/ro/catalog/index') . '</loc><lastmod>' . now()->toAtomString() . '</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>';
        $sitemapContent .= '<url><loc>' . url('ru/gallery/preview') . '</loc><lastmod>' . now()->toAtomString() . '</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>';
        $sitemapContent .= '<url><loc>' . url('ro/gallery/preview') . '</loc><lastmod>' . now()->toAtomString() . '</lastmod><changefreq>weekly</changefreq><priority>0.9</priority></url>';

        ///ru/gallery/preview
        $sitemapContent = $this->addBaseCategory($sitemapContent, $host);
        $sitemapContent .= '</urlset>';

        if (!File::exists($path)) {
            File::makeDirectory(dirname($path), 0755, true);
            File::put($path, $sitemapContent);
        }else{
            File::put($path, $sitemapContent);
        }
    }

    private function addBaseCategory($siteMap,$host)
    {
        $categorySite = Category::getCategoryForHost($host);
        foreach ($categorySite as $cat){
            $path = $cat->lang.'/'.'catalog/category/'.$cat->slug;
            $siteMap.= '<url><loc>' . url($path) . '</loc><lastmod>' . now()->toAtomString() . '</lastmod><changefreq>weekly</changefreq><priority>0.7</priority></url>';

        }
        $pagesSite = Page::getPageForHost($host);
        foreach ($pagesSite as $page){
            $path = $page->lang.'/'.'page/'.$page->slug;
            $siteMap.= '<url><loc>' . url($path) . '</loc><lastmod>' . now()->toAtomString() . '</lastmod><changefreq>weekly</changefreq><priority>0.7</priority></url>';

        }
        $productSite = Product::getProductForHost($host);
        foreach ($productSite as $product){
            $path = $product->lang.'/'.'catalog/product/'.$product->slug;
            $siteMap.= '<url><loc>' . url($path) . '</loc><lastmod>' . now()->toAtomString() . '</lastmod><changefreq>daily</changefreq><priority>0.7</priority></url>';

        }
        return $siteMap;
    }
}
