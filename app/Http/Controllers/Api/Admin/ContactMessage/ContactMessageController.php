<?php

namespace App\Http\Controllers\Api\Admin\ContactMessage;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactMessageResource;
use App\Services\Admin\ContactMessage\ContactMessageService as AdminContactMessageService;

class ContactMessageController extends Controller
{
    public function __construct(protected AdminContactMessageService $contactMessagesService)
    {
    }

    /**
     * @OA\Get(
     *     path="/admin/contact-messages",
     *     security={{ "bearerAuth": {} }},
     *     summary="Get a list of contact messages",
     *     tags={"Admin" , "Admin - ContactMessage"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of contact messages",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/ContactMessageResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */
    public function index()
    {
        return $this->contactMessagesService->getAll();
    }


    /**
     * @OA\Delete(
     *     path="/admin/contact-messages/{id}",
     *     summary="Soft delete a contact message",
     *     tags={"Admin" , "Admin - ContactMessage"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the contact message to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     security={{ "bearerAuth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="Contact message soft deleted",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="soft deleted"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */
    public function delete(ContactMessage $contactMessage)
    {
        $contactMessage->deleteOrFail();
        return success();
    }
}
