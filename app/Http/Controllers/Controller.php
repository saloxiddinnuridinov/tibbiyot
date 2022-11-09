<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="Anatomiya",
 *    version="1.0.0",
 * )
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer"
 * )
 * @OA\Tag(
 * name = "Auth",
 * description = "Authdan o'tish",
 * ),
 * 
 * @OA\Tag(
 * name = "Category",
 * description = "Category CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "User",
 * description = "User CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "Student",
 * description = "Student CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "Content",
 * description = "Content CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "Lessons",
 * description = "Lesson CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "Terms",
 * description = "Term CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "Object_File",
 * description = "Object File CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "Video_File",
 * description = "Video File CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "Image_File",
 * description = "Image File CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "Lesson_Join_Object_File",
 * description = "Lesson Join Object File CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "Lesson_Join_Video_File",
 * description = "Lesson Join Video File CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "Lesson_Join_Image_File",
 * description = "Lesson Join Image File CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "Lesson_Join_Term",
 * description = "Lesson Join Terms CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "Terms_Join_Object_File",
 * description = "Terms Join Object File CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "Terms_Join_Video_File",
 * description = "Terms Join Video File CRUD",
 * ),
 * 
 * @OA\Tag(
 * name = "Terms_Join_Image_File",
 * description = "Terms Join Image File CRUD",
 * ),
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}


// Install JWT
// Publish JWT Config
// Generate JWT Secret
// Configure Auth configuration
// Implement JWTSubject interface in User model
// Create API route
// Create AuthController with login, register, refresh, logout and profile method
// Create Todo Model with migration and resource TodoController
// Migrate database
// Modify UserFactory
// Create and modify TodoFactory
// Use of a Psy Shell Laravel Tinker
// Create some dummy users and Todo data
// Use a RESTful API client Postman
// Test User login, register, refresh, logout and user profile
// Test Todo view, create, modify and delete
