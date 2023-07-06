<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Traits\HasCommentRelationshipTrait;
use Carbon\Doctrine\DateTimeDefaultPrecision;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $surname
 * @property Carbon|null $date_of_birth
 * @property Carbon|null $deleted_at
 * @property string|null $local_path
 * @property string|null $public_path
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLocalPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePublicPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes, HasCommentRelationshipTrait;

    protected $fillable = [
        'name',
        'surname',
        'date_of_birth',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'datetime',
    ];

    public function getPosts(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->posts;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): mixed
    {
        return $this->password;
    }

    public function setPassword(mixed $password): void
    {
        $this->password = $password;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getDateOfBirth(): ?\Illuminate\Support\Carbon
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(?\Illuminate\Support\Carbon $date_of_birth): void
    {
        $this->date_of_birth = $date_of_birth;
    }

    public function getLocalPath(): ?string
    {
        return $this->local_path;
    }

    public function setLocalPath(?string $local_path): void
    {
        $this->local_path = $local_path;
    }

    public function getPublicPath(): ?string
    {
        return $this->public_path;
    }

    public function setPublicPath(?string $public_path): void
    {
        $this->public_path = $public_path;
    }

    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function createOrUpdate(array $requestData): void
    {
        if (Arr::has($requestData, 'password')) {
            $pass = Hash::make($requestData['password']);
            $this->setPassword($pass);
        }

        $date = $requestData['date_of_birth'];
        if ($date != null) {
            $date = Carbon::parse($date . ' 00:00:00');
            $this->setDateOfBirth($date);
        }

        if ($date === null) {
            $this->setDateOfBirth($date);
        }

        $this->setName($requestData['name']);
        $this->setEmail($requestData['email']);
        $this->setSurname($requestData['surname']);
    }

    public function uploadFile(?UploadedFile $uploadedFile)
    {
        if ($uploadedFile instanceof UploadedFile) {
            $storage = Storage::disk('public');
            $path = '/users/' . $uploadedFile->getClientOriginalName();
            $storage->put($path, $uploadedFile->get());
            $local_path = 'public' . $path;
            $public_path = $storage->url($path);
            $this->setPublicPath($public_path);
            $this->setLocalPath($local_path);
        };
        return $path ?? null;
    }
}