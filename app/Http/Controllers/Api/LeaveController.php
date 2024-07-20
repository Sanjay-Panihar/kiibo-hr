<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Leave;
use Error;
use ErrorException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    public function store(Request $request)
    {
        return $this->updateOrCreate($request, 'add');
    }
    public function update(Request $request, $id)
    {
        return $this->updateOrCreate($request, 'update');
    }
    public function updateOrCreate(Request $request, $action)
    {
        if (!in_array($action, array('add', 'update')))
            throw new NotFoundHttpException();
        else {
            $id = $request->id ?? 0;
            $this->action = $action;
            $this->browser = $request->header('User-Agent');
            $this->ip_address = $request->ip();
            $data = $request->all();
            try {
                $validator = Validator::make($data, [
                    'start_date'    => 'required|date|after:yesterday',
                    'end_date'      => 'required|date|after:start_date',
                    'reason'        => 'required|max:255|string',
                    'no_of_days'    => 'required|numeric',
                    'leave_type'    => 'required|numeric',
                ]);
                if ($validator->fails()) {
                    $this->status = false;
                    $this->statusCode = 422;
                    $this->error['fields'] = $validator->errors();
                } else {
                    DB::beginTransaction();
                    if ($id) {
                        $data['updated_by'] = Auth::id();
                    } else {
                        $data['created_by'] = Auth::id();
                    }
                    $output = Leave::updateOrCreate(['id' => $id], $data);
                    $id = $output->id;
                    $this->response['description'] = 'Leave ' . rtrim($this->action, 'e') . 'ed successfully.';
                    $this->response['data'] = ["id" => $id];
                    DB::commit();
                    $id = $output->id;
                }
            } catch (ErrorException | Error $e) {
                DB::rollBack();
                $this->status = false;
                $this->statusCode = 500;
                $this->error['code'] = 'PC0003';
                $this->error['title'] = 'INTERNAL_ERROR';
                $this->error['description'] = 'Syntax Error.';
                $this->error['details'] = ['message' => $e->getMessage()];
            } catch (QueryException $e) {
                DB::rollBack();
                $this->status = false;
                $this->statusCode = 502;
                $this->error['code'] = 'PC0004';
                $this->error['title'] = 'DB_ERROR';
                $this->error['description'] = 'SQL Syntax Error.';
                $this->error['details'] = ['message' => $e->getMessage()];
            }

            $response = ["status" => $this->status, "statusCode" => $this->statusCode, "error" => $this->error, "response" => $this->response];

            unset($response["error"]["details"]);
            return response()->json($response, $this->statusCode);
        }
    }
}
