<?php

/*
 * Copyright 2014 Brian Smith <wormling@gmail.com>.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace phparia\Events;

use phparia\Client\AriClient;
use phparia\Resources\LiveRecording;

/**
 * Event showing the completion of a recording operation.
 *
 * @author Brian Smith <wormling@gmail.com>
 */
class RecordingFinished extends Event implements IdentifiableEventInterface
{
    /**
     * @var LiveRecording Recording control object
     */
    private $recording;

    /**
     * @return LiveRecording Recording control object
     */
    public function getRecording()
    {
        return $this->recording;
    }

    public function getEventId()
    {
        return "{$this->getType()}_{$this->getRecording()->getName()}";
    }

    /**
     * @param AriClient $client
     * @param string $response
     */
    public function __construct(AriClient $client, $response)
    {
        parent::__construct($client, $response);

        $this->recording = $this->getResponseValue('recording', '\phparia\Resources\LiveRecording', $client);
    }
}
