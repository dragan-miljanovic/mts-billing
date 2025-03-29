<?php

namespace App\Http\Controllers;

use App\Http\Requests\Confirmation\DeleteConfirmationRequest;
use App\Http\Requests\Confirmation\ShowConfirmationRequest;
use App\Services\Confirmation\Contracts\ConfirmationCrudServiceInterface;
use App\Utils\Contracts\LoggerInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class ConfirmationController extends Controller
{
    public function __construct(
        private ConfirmationCrudServiceInterface $confirmationCrudService,
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
            $confirmations = $this->confirmationCrudService->findAllWithPagination(5);
        } catch (RuntimeException $e) {
            $this->logger ->error('Error while getting confirmations: ', ['message' => $e]);

            request()->session()->flash('message', 'Unexpected error, please try again later.');
        }

        return view('confirmation.index', compact('confirmations'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowConfirmationRequest $request): View|Application|Factory
    {
        $id = $request->input('confirmation');

        try {
            $confirmation = $this->confirmationCrudService->find($id);
        } catch (RuntimeException $e) {
            $this->logger ->error('Error while getting single confirmation: ', ['message' => $e]);

            request()->session()->flash('message', 'Unexpected error, please try again later.');
        }

        return view('confirmation.show', compact('confirmation'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteConfirmationRequest $request): RedirectResponse
    {
        $id = $request->input('confirmation');

        try {
            $this->confirmationCrudService->delete($id);
        } catch (RuntimeException $e) {
            $this->logger ->error('Error while deleting confirmation: ', ['message' => $e]);

            request()->session()->flash('message', 'Unexpected error, please try again later.');
        }

        return redirect()->route('call-charges.index')->with('message', 'Confirmation successfully deleted.');
    }
}
