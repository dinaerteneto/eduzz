<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use App\Entities\Person;
use App\Repositories\PersonRepository;

class PersonController extends Controller
{
    /**
     * @api {get} /person/get-all get all users
     * @apiVersion 1.0.0
     * @apiName get-all
     * @apiGroup person
     *
     * @apiParam {Integer} [rows] number of records to page
     * @apiParam {Integer} [page] number of current page
     */
    public function getAll(Request $request)
    {
        $page = null !== ($request->get('page')) ? $request->page : 0;
        $rows = null !== ($request->get('rows')) ? $request->rows : 15;
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });
        $people = Person::with(['contacts' => function ($model) {
            return $model->with('contactType');
        }]);
        $paginate = $people->paginate($rows);
        return response()->json($paginate);
    }

    /**
     * @api {get} /person/search Search people by name
     * @apiVersion 1.0.0
     * @apiName search
     * @apiGroup person
     *
     * @apiParam {Integer} [rows] number of records to page
     * @apiParam {Integer} [page] number of current page
     * @apiParam {String} name name or last name of user for search
     */
    public function search(Request $request)
    {
        Paginator::currentPageResolver(function () use ($request) {
            return $request->page;
        });
        $person = Person::with(['contacts' => function ($model) {
            return $model->with('contactType');
        }]);
        if(isset($request->name) || !empty($request->name)) {
            $person->where('name', 'like', "%{$request->name}%");
            $person->orWhere('last_name', 'like', "%{$request->name}%");
        }
        $paginate = $person->paginate($request->rows);
        return response()->json($paginate);
    }

    /**
     * @api {post} /person/create create a specific person
     * @apiVersion 1.0.0
     * @apiName create
     * @apiGroup person
     *
     * @paiParam {String} name name of the person
     * @paiParam {String} last_name last name of the person
     * @paiParam {String} last_name last name of the person
     * @apiParam {Date} date_birth date of the birth yyyy-mm-dd
     * @apiParam {String} gender gender of the person. Use M for Male or F for female
     *
	 * @apiParam {Array[]} contact
	 * @apiParam {Integer=1-E-mail,2-Cellphone,3-Comercialphone,4-Homephone,5-Scrapsphone} contact.contact_type_id
	 * @apiParam {String} contact.value
     */
    public function create(Request $request)
    {
        $person = new Person();
        $person->fill($request->all());
        $repository = new PersonRepository($person);
        $repository->save();

        // add contacts
        if (null !== $request->get('contact')) {
            $repository->addContact($request->get('contact'));
        }

        return response()->json($person);
    }

    /**
     * @api {get} /person/:id get a specific person
     * @apiVersion 1.0.0
     * @apiName read
     * @apiGroup person
     *
     * @apiParam {Integer} id id of the person
     */
    public function read(Request $request, $id)
    {
        $person = new Person();
        $repository = new PersonRepository($person);
        return response()->json($repository->read($id));
    }

    /**
     * @api {put} /person/:id update a specific person
     * @apiVersion 1.0.0
     * @apiName update
     * @apiGroup person
     *
     * @apiParam {Integer} id id of the person
     * @paiParam {String} name name of the person
     * @paiParam {String} last_name last name of the person
     * @paiParam {String} last_name last name of the person
     * @apiParam {Date} date_birth date of the birth yyyy-mm-dd
     * @apiParam {String} gender gender of the person. Use M for Male or F for female
     *
	 * @apiParam {Array[]} contact
	 * @apiParam {Integer=1-E-mail,2-Cellphone,3-Comercialphone,4-Homephone,5-Scrapsphone} contact.contact_type_id
	 * @apiParam {String} contact.value
     */
    public function update(Request $request, $id)
    {
        $person = Person::find($id);
        $repository = new PersonRepository($person);
        $repository->save();

        // add contacts
        if (null !== $request->get('contact')) {
            $repository->addContact($request->get('contact'));
        }
        return response()->json($person);
    }

    /**
     * @api {delete} /person/:id delete a specific person
     * @apiVersion 1.0.0
     * @apiName delete
     * @apiGroup person
     *
     * @apiParam {Integer} id id of the person
     */
    public function delete(Request $request, $id)
    {
        $person = Person::find($id);
        $person->delete();
        return response()->json(true);
    }
}
