<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerW4cKz7o\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerW4cKz7o/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerW4cKz7o.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerW4cKz7o\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerW4cKz7o\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'W4cKz7o',
    'container.build_id' => '82c0f1ea',
    'container.build_time' => 1574797413,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerW4cKz7o');
