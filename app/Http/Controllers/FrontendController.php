<?php

namespace App\Http\Controllers;

use App\Services\PersonnelDataService;
use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class FrontendController extends Controller
{
    // public function index()
    // {
    //     return view('frontend.home');
    // }

    public function index(PersonnelDataService $personnelService)
    {
        $allResearchers = $personnelService->getAllResearchers();
        
        // Get current page from query string or default to 1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10; // Items per page
        
        // Slice the array to get the items for the current page
        $currentPageItems = array_slice($allResearchers, ($currentPage - 1) * $perPage, $perPage);
        
        // Create paginator instance
        $researchers = new LengthAwarePaginator(
            $currentPageItems,
            count($allResearchers),
            $perPage,
            $currentPage,
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
        
        return view('frontend.home', compact('researchers'));
    }

    // public function show($slug)
    // {
    //     return view('frontend.show');
    // }
    public function show($slug, PersonnelDataService $personnelService)
    {
        $researcher = $personnelService->getResearcherById($slug);
        
        if (!$researcher) {
            abort(404);
        }
        // dd($researcher);
        
        return view('frontend.show', compact('researcher'));
    }

    public function temp(PersonnelDataService $personnelService) {
        // Get the modified data
        $personnelData = $personnelService->modResearchData();
        
        // Start building the output string
        $output = "array(\n";
        
        foreach ($personnelData as $item) {
            $output .= "    array(";
            $fields = [];
            
            foreach ($item as $key => $value) {
                // Escape single quotes in values
                $escapedValue = str_replace("'", "\\'", $value);
                $fields[] = "'$key' => '$escapedValue'";
            }
            
            $output .= implode(", ", $fields);
            $output .= "),\n";
        }
        
        $output .= ");";
        
        // Write to file
        file_put_contents(public_path('text.txt'), $output);
        
        return response()->json(['message' => 'Array written in exact format']);
    }
}
