<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Guitar;
use Symfony\Contracts\Service\Attribute\Required;

class GuitarsController extends Controller
{

    private static function getData()
    {
        return [
            ['id' => 1, 'name' => 'American Standart Strat', 'brand' => 'fender', 'year_made' => '2015'],
            ['id' => 2, 'name' => 'Starla S2', 'brand' => 'PRS', 'year_made' => '2012'],
            ['id' => 3, 'name' => 'Explorer', 'brand' => 'Gibson', 'year_made' => '2014'],
            ['id' => 4, 'name' => 'Talman', 'brand' => 'Ibanez', 'year_made' => '2011'],
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //GET

        return view('guitars.index', [
            'guitars' => Guitar::all(),
            'userInput' => '<script>alert("hello")</script>'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //GET
        return view('guitars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //SHOW

        $request->validate([
            'guitar-name' => 'required',
            'brand' => 'required',
            'year' => ['required', 'integer']

        ]);

        $guitar = new Guitar();

        $guitar->name = $request->input('guitar-name');
        $guitar->brand = $request->input('brand');
        $guitar->year_made = $request->input('year');

        $guitar->save();

        return redirect()->route('guitars.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($guitar)
    {
        //GET

        return view('guitars.show', [
            'guitar' => Guitar::findOrFail($guitar) //clean code (it's an alternative to the if(error) but in this case it will fail automatically and return a 404 if it cant find a record )
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($guitar)
    {
        //GET
        return view('guitars.edit', [
            'guitar' => Guitar::findOrFail($guitar)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $guitar)
    {
        //POST
        $request->validate([
            'guitar-name' => 'required',
            'brand' => 'required',
            'year' => ['required', 'integer']

        ]);

        $record = Guitar::findOrFail($guitar); // we will fetch the data from the database

        $record->name = $request->input('guitar-name');
        $record->brand = $request->input('brand');
        $record->year_made = $request->input('year');

        $record->save();

        return redirect()->route('guitars.show', $guitar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        var_dump($id);
    }
}
