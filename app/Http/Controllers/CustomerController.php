<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function getCustomers(Request $request)
    {
        $query = Customer::query();
 
        // Pencarian berdasarkan nama
        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }
 
        // Filter berdasarkan umur
        if ($request->has('age_filter') && $request->input('age_filter') !== '') {
            $age = $request->input('age_filter');
            $query->where('age', '>=', $age);
        }
 
        $customers = $query->paginate(3);
 
        return view('customer.list')->with(compact('customers'));
    }

    public function createCustomer()
    {
        return view('customer.form');
    }

    public function insertCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email',
            'address' => 'required|string|max:100',
            'age' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->age = $request->age;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $customer->image = $imageName;
        }

        $customer->save();
        return redirect()->route('customers');
    }

    public function showFormUpdate($customer_id)
    {
        $customer = Customer::findOrFail($customer_id);
        return view('customer.edit')->with(compact('customer'));
    }

    public function updateCustomer(Request $request, $customer_id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'address' => 'required|string|max:100',
            'age' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $customer = Customer::findOrFail($customer_id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->age = $request->age;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($customer->image && file_exists(public_path('images/' . $customer->image))) {
                unlink(public_path('images/' . $customer->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $customer->image = $imageName;
        }

        $customer->save();
        return redirect()->route('customers');
    }

    public function deleteCustomer($customer_id)
    {
        $customer = Customer::findOrFail($customer_id);

        // Delete image if exists
        if ($customer->image && file_exists(public_path('images/' . $customer->image))) {
            unlink(public_path('images/' . $customer->image));
        }

        $customer->delete();
        return redirect()->route('customers');
    }
}
