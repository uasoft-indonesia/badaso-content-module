<?php

/**
 * @OA\Get(
 *      path="/v1/module/content",
 *      operationId="browseModuleContentV1Content",
 *      tags={"Module Content"},
 *      summary="Browse Content",
 *      description="Browse Content",
 *      @OA\Response(response=200, description="Successful operation"),
 *      @OA\Response(response=400, description="Bad request"),
 *      @OA\Response(response=401, description="Unauthorized"),
 *      @OA\Response(response=402, description="Payment Required"),
 *      security={
 *          {"bearerAuth": {}}
 *      }
 * )
 */

/**
 * @OA\Get(
 *      path="/v1/module/content/read",
 *      operationId="browseModuleContentV1ContentRead",
 *      tags={"Module Content"},
 *      summary="Read Content",
 *      description="Read Content",
 *      @OA\Parameter(
 *          name="id",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *      @OA\Response(response=200, description="Successful operation"),
 *      @OA\Response(response=400, description="Bad request"),
 *      @OA\Response(response=401, description="Unauthorized"),
 *      @OA\Response(response=402, description="Payment Required"),
 * )
 */
 
 /**
 * @OA\Get(
 *      path="/v1/module/content/fetch",
 *      operationId="browseModuleContentV1ContentFetch",
 *      tags={"Module Content"},
 *      summary="Fetch Content",
 *      description="Fetch Content",
 *      @OA\Parameter(
 *          name="slug",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *      @OA\Response(response=200, description="Successful operation"),
 *      @OA\Response(response=400, description="Bad request"),
 *      @OA\Response(response=401, description="Unauthorized"),
 *      @OA\Response(response=402, description="Payment Required"),
 * )
 */ 
 
 /**
 * @OA\Get(
 *      path="/v1/module/content/fetch-multiple",
 *      operationId="browseModuleContentV1ContentFetchMultiple",
 *      tags={"Module Content"},
 *      summary="Fetch Multiple Content",
 *      description="Fetch Multiple Content",
 *      @OA\Parameter(
 *          name="slug",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *      @OA\Response(response=200, description="Successful operation"),
 *      @OA\Response(response=400, description="Bad request"),
 *      @OA\Response(response=401, description="Unauthorized"),
 *      @OA\Response(response=402, description="Payment Required"),
 * )
 */

