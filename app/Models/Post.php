<?php

namespace App\Models;

use App\Http\Traits\HasCommentRelationshipTrait;
use App\Http\Traits\HasUserRelationshipTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Enums\PostCommentParamEnum;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property string $short_description
 * @property string $text
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Post withoutTrashed()
 * @mixin \Eloquent
 */
class Post extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasUserRelationshipTrait, HasCommentRelationshipTrait;

    public const MEDIA_COLLECTION_PREVIEW = 'preview';

    protected $casts = [
        'param' => PostCommentParamEnum::class,
    ];

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getShortDescription(): string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $short_description): void
    {
        $this->short_description = $short_description;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function createOrUpdate(array $requestData): void
    {
        $user_id = Auth::id();
        $this->setTitle($requestData['title']);
        $this->setShortDescription($requestData['short_description']);
        $this->setText($requestData['text']);
        $this->setUserId($user_id);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('large')
            ->format(Manipulations::FORMAT_WEBP)
            ->width(1200);
        $this
            ->addMediaConversion('small')
            ->format(Manipulations::FORMAT_WEBP)
            ->width(300);
    }

    public function uploadFile(?UploadedFile $uploadedFile): void
    {
        $media = $this->addMedia($uploadedFile)
            ->toMediaCollection(self::MEDIA_COLLECTION_PREVIEW);
        $data = getimagesize($media->getPath());
        $width = $data[0];
        $height = $data[1];
        $media->setCustomProperty('width', $width);
        $media->setCustomProperty('height', $height);
        $media->save();
    }

    public function scopeFilter(Builder $query, array $frd): Builder
    {
        foreach ($frd as $key => $value) {
            switch ($key) {
                case 'search':
                    {
                        $query->filterSearch($value);
                    }
                    break;

                case 'parameter':
                    {
                        $query->filterHasComments($value);
                    }
                    break;
            }
        }
        return $query;
    }

    public function scopeFilterSearch(Builder $query, ?string $text): Builder
    {
        return $query->where('title', 'LIKE', '%' . $text . '%')
            ->orWhere('short_description', 'LIKE', '%' . $text . '%')
            ->orWhere('text', 'LIKE', '%' . $text . '%');
    }

    public function scopeFilterHasComments(Builder $query, int $param): Builder
    {
        switch ($param) {
            case PostCommentParamEnum::WITH_COMMENTS:
                {
                    $query->whereHas('comments');
                }
                break;

            case PostCommentParamEnum::WITHOUT_COMMENTS:
                {
                    $query->whereDoesntHave('comments');
                }
                break;
        }
        return $query;
    }

}