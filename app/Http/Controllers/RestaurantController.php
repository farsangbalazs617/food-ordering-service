<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Menu;

/**
 * Provides a set of API endpoints for 
 * managing restaurants and their menus.
 * 
 * @author Farsang Balázs <farsang.balazs617@gmail.com>
 */
class RestaurantController extends Controller
{
    /**
     * Retrieve all restaurants.
     *
     * @return \Illuminate\Http\JsonResponse The list of all restaurants as a JSON response.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $restaurants = Restaurant::all();
        return response()->json($restaurants);
    }

    /**
     * Retrieve a restaurant by its ID.
     *
     * @param int $id The ID of the restaurant to retrieve.
     * 
     * @return \Illuminate\Http\JsonResponse The restaurant data as a JSON response.
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        }
        return response()->json($restaurant);
    }

    /**
     * Retrieve the menu items for a given restaurant.
     *
     * @param int $id The ID of the restaurant to retrieve the menu for.
     * 
     * @return \Illuminate\Http\JsonResponse The menu items for the restaurant as a JSON response.
     */
    public function menu($id): \Illuminate\Http\JsonResponse
    {
        $menu = Menu::where('restaurant_id', $id)->get();
        return response()->json($menu);
    }
}
