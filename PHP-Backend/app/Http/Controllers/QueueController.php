<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SplQueue;

class QueueController extends Controller
{
    protected $queues;

    public function __construct()
    {
        $this->queues = new Collection();
    }

    public function createQueue(Request $request, $queueName)
    {
        if (!$this->queues->has($queueName)) {
            $this->queues->put($queueName, new \SplQueue());
            return response()->json(['message' => "Queue '$queueName' created"]);
        } else {
            return response()->json(['message' => "Queue '$queueName' already exists"]);
        }
    }

    public function addToQueue(Request $request, $queueName)
    {
        if ($this->queues->has($queueName)) {
            $queue = $this->queues->get($queueName);
            $data = $request->only(['name', 'address', 'mobile']);
            $queue->enqueue($data);

            return response()->json(['message' => "Added to queue '$queueName'"]);
        } else {
            return response()->json(['message' => "Queue '$queueName' not found"], 404);
        }
    }

    public function processQueue(Request $request, $queueName)
    {
        if ($this->queues->has($queueName)) {
            $queue = $this->queues->get($queueName);
            $processed = [];

            while (!$queue->isEmpty()) {
                $data = $queue->dequeue();
                $processed[] = $data;
            }

            return response()->json(['message' => "Processed queue '$queueName'", 'data' => $processed]);
        } else {
            return response()->json(['message' => "Queue '$queueName' not found"], 404);
        }
    }

    }
}
