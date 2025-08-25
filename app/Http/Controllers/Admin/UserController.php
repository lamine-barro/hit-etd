<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserAccountCreated;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use HandlesImageUpload;
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        if ($request->has('is_active') && $request->is_active != '') {
            $query->where('is_active', $request->is_active === '1');
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('pages.admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('orders');
        return view('pages.admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('pages.admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'nullable|string|max:255',
            'category' => 'required|string',
            'profession' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'startup_description' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'is_active' => 'boolean',
            'is_verified' => 'boolean',
            'lock_raison' => 'nullable|string',
            'documents' => 'nullable|string',
            'needs' => 'nullable|string',
        ]);
        $validated['is_active'] = $request->has('is_active');
        $validated['is_verified'] = $request->has('is_verified');

        // Gérer l'upload de la photo de profil avec optimisation
        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $this->optimizeProfilePicture($request->file('profile_picture'));
        }

        $user = User::create($validated);

        // Envoyer la notification de création de compte
        $adminName = Auth::user()->name ?? 'Administrateur';
        $user->notify(new UserAccountCreated($adminName));

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès. Un email de bienvenue a été envoyé.');
    }

    public function edit(User $user)
    {
        return view('pages.admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:255',
            'category' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'is_active' => 'boolean',
            'is_verified' => 'boolean',
            'password' => 'nullable|string|min:8',
            'lock_raison' => 'nullable|string',
            'documents' => 'nullable|string',
            'needs' => 'nullable|string',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['is_verified'] = $request->has('is_verified');

        // Gérer l'upload de la nouvelle photo de profil avec optimisation
        if ($request->hasFile('profile_picture')) {
            // Supprimer l'ancienne photo si elle existe
            $this->deleteImage($user->profile_picture);
            
            // Optimiser et sauvegarder la nouvelle photo
            $validated['profile_picture'] = $this->optimizeProfilePicture($request->file('profile_picture'));
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        // Supprimer la photo de profil si elle existe
        $this->deleteImage($user->profile_picture);
        
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function toggleStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'activé' : 'désactivé';
        
        // Retourner une réponse JSON pour les requêtes AJAX
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Utilisateur {$status} avec succès.",
                'is_active' => $user->is_active
            ]);
        }
        
        return redirect()->back()->with('success', "Utilisateur {$status} avec succès.");
    }
}