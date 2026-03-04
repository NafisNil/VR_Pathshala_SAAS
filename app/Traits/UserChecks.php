namespace App\Traits;

trait UserChecks {
    public function checkActive(?\App\Models\User $user)
    {
        if (!$user) {
            abort(response()->json(['message' => 'User not found or inactive'], 404));
        }
    }
}