<?php

namespace App\Http\Controllers;

use App\Http\Requests\CallCharge\DeleteCallChargeRequest;
use App\Http\Requests\CallCharge\ShowCallChargeRequest;
use App\Services\CallCharge\Contracts\CallChargeCrudServiceInterface;
use App\Utils\Contracts\LoggerInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class CallChargeController extends Controller
{
    public function __construct(
        private CallChargeCrudServiceInterface $callChargeCrudService,
        private LoggerInterface $logger,
    ){
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory
    {
        try {
            $callCharges = $this->callChargeCrudService->findAllWithPagination(5);
        } catch (Exception $e) {
            $this->logger ->error('Error while getting call charges: ', ['message' => $e]);

            request()->session()->flash('message', 'Unexpected error, please try again later.');
        }

        return view('call-charge.index', compact('callCharges'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowCallChargeRequest $request): View|Application|Factory
    {
        $id = $request->input('call_charge');

        try {
            $callCharge = $this->callChargeCrudService->find($id);
        } catch (Exception $e) {
            $this->logger ->error('Error while getting single call charge: ', ['message' => $e]);

            request()->session()->flash('message', 'Unexpected error, please try again later.');
        }

        return view('call-charge.show', compact('callCharge'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteCallChargeRequest $request): RedirectResponse
    {
        $id = $request->input('call_charge');

        try {
            $this->callChargeCrudService->delete($id);
        } catch (Exception $e) {
            $this->logger ->error('Error while deleting call charges: ', ['message' => $e]);

            request()->session()->flash('message', 'Unexpected error, please try again later.');
        }

        return redirect()->route('call-charges.index')->with('message', 'Call charge successfully deleted.');
    }
}
