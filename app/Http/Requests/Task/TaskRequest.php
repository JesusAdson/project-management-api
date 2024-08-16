<?php

namespace App\Http\Requests\Task;

use App\Enums\Task\TaskPriorityEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'description' => ['sometimes', 'string', 'max:200'],
            'priority' => Rule::enum(TaskPriorityEnum::class),
            'status' => ['sometimes', Rule::enum(TaskStatusEnum::class)],
            'start_date' => 'required',
            'end_date' => 'required',
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
