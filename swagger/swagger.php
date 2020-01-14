<?php
use OpenApi\Annotations as OA;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Swagger LinkeBin",
 *         @OA\License(name="LinkeBin")
 *     ),
 *     @OA\Server(
 *         description="Api server",
 *         url="linkebin.swagger.io",
 *     ),
 * )
 */
/**
 *  @OA\Schema(
 *      schema="Error",
 *      required={"code", "message"},
 *      @OA\Property(
 *          property="code",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="message",
 *          type="string"
 *      )
 *  ),
 *  @OA\Schema(
 *      schema="Bins",
 *      type="array",
 *      @OA\Items(ref="#/components/schemas/Bin")
 *  )
 */