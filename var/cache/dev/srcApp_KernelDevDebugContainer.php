<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerXzdEW4f\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerXzdEW4f/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerXzdEW4f.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerXzdEW4f\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerXzdEW4f\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'XzdEW4f',
    'container.build_id' => '65d6f963',
    'container.build_time' => 1574955648,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerXzdEW4f');
