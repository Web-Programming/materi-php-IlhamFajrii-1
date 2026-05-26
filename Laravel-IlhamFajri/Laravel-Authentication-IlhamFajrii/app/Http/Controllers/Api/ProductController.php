<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    /**
     * Mendapatkan semua produk
     * GET /api/products
     */
    public function index()
    {
        try {
            $products = Product::all();
            
            return response()->json([
                'success' => true,
                'message' => 'Data produk berhasil diambil',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menyimpan produk baru
     * POST /api/products
     */
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'unit' => 'required|string|max:50',
                'stock' => 'required|integer|min:0',
                'status' => 'required|string|in:aktif,nonaktif',
                'description' => 'nullable|string'
            ]);

            // Buat produk baru
            $product = Product::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan',
                'data' => $product
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mendapatkan detail produk
     * GET /api/products/{id}
     */
    public function show(int $id)
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Data produk berhasil diambil',
                'data' => $product
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Memperbarui produk
     * PUT /api/products/{id}
     */
    public function update(Request $request, int $id)
    {
        try {
            $product = Product::findOrFail($id);

            // Validasi input
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'price' => 'sometimes|required|numeric|min:0',
                'unit' => 'sometimes|required|string|max:50',
                'stock' => 'sometimes|required|integer|min:0',
                'status' => 'sometimes|required|string|in:aktif,nonaktif',
                'description' => 'nullable|string'
            ]);

            // Update produk
            $product->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil diperbarui',
                'data' => $product
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus produk
     * DELETE /api/products/{id}
     */
    public function destroy(int $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus',
                'data' => $product
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mencari produk berdasarkan nama atau status
     * GET /api/products/search?keyword=...&status=...
     */
    public function search(Request $request)
    {
        try {
            $query = Product::query();

            // Filter berdasarkan keyword (nama dan deskripsi)
            if ($request->has('keyword')) {
                $keyword = $request->input('keyword');
                $query->where('name', 'like', "%{$keyword}%")
                      ->orWhere('description', 'like', "%{$keyword}%");
            }

            // Filter berdasarkan status
            if ($request->has('status')) {
                $query->where('status', $request->input('status'));
            }

            $products = $query->get();

            return response()->json([
                'success' => true,
                'message' => 'Pencarian produk berhasil',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mencari produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
