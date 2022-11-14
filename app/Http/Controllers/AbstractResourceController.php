<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentsRequest;
use App\Http\Services\AbstractAdvancedResourceService;
use App\Http\Services\AbstractResourceService;
use App\Http\Services\AppointmentService;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as RequestFacade;
use Inertia\Inertia;
use Inertia\Response;

abstract class AbstractResourceController extends Controller
{
    const RENDER_METHOD_INERTIA = 'inertia';

    protected static $mainService = AbstractAdvancedResourceService::class;

    protected static $requestType = null;

    protected static string $templatePrefix = '';

    protected static string $renderMethod = 'inertia';

    protected string $accept;

    public function __construct(Request $request)
    {
//        $this->accept = $request->header('Accept', null);
    }

    /**
     * @param $data
     * @param $template
     * @param Request|null $request
     * @return RedirectResponse|Response
     */
    protected static function returnResult($data, $template = null, Request $request = null)
    {

        if (static::$renderMethod === static::RENDER_METHOD_INERTIA) {

            if ($request->header('Accept', null) === 'application/json') {
                return $data;
            }

            if (!$template) {

//                return Redirect::route('apples.index');
                if (isset($data['success']) && $data['success'] === false) {
                    return redirect()->back()->with([
                        'errorMessage' => $data['message'] ?? '',
                    ]);
                    return Redirect::back()->withErrors(['error' => 'error1']);
//                    return Redirect::back()->withErrors(['error' => $data['message'] ?? '']);


                    return Redirect::back()->with('error', 'error');
                    return Redirect::back()->with('success', false)->with('message', $data['message'] ?? '');
                }
                return Redirect::back()->with(['success' => true, 'errorMessage' => '']);
                return redirect(route('apples.index'));
//                return Redirect::back()->with('success', 'Organization updated.');
//                return $data;
            }

            return Inertia::render(static::$templatePrefix . $template, $data);
        }
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data = static::$mainService::list($request->all());
        return static::returnResult($data, 'Index', $request);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        return static::returnResult([], 'Create', $request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        if (static::$requestType) {
            $requestData = $request->validate(static::$requestType::generateInputRequestArray());
        }
        $data = static::$mainService::store($requestData);
        return static::returnResult($data,  null, $request);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function show(Request $request, int $id)
    {
        $data = static::$mainService::show($id);
        return static::returnResult($data,  'Show', $request);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, int $id)
    {
        $data = static::$mainService::show($id);
        return static::returnResult($data,  'Edit', $request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int $id
     * @return RedirectResponse|Response
     */
    public function update(Request $request, int $id)
    {
        if (static::$requestType) {
            $requestData = $request->validate(static::$requestType::$updateRequestRules);
        } else {
            $requestData = $request->all();
        }

        $data = static::$mainService::update($requestData, $id);
        return static::returnResult($data,  null, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointments
     * @return Model
     */
    public function destroy(Request $request, int $id)
    {
        $data = static::$mainService::destroy($id);
        return static::returnResult($data,  null, $request);
    }
}
