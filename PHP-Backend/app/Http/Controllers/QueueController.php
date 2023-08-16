<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SplQueue;

class QueueController extends Controller
{
    protected $queue;

    public function __construct()
    {
        $this->queue = new SplQueue();
    }

    public function addToQueue(Request $request)
    {
        $data = $request->only(['name', 'address', 'mobile']);
        $this->queue->enqueue($data);
        
        return response()->json(['message' => 'Added to queue']);
    }

    public function processQueue()
    {
        $processed = [];

        while (!$this->queue->isEmpty()) {
            $data = $this->queue->dequeue();
            $processed[] = $data;
        }

        return response()->json(['message' => 'Processed queue', 'data' => $processed]);
    }
}
